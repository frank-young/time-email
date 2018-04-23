<?php

namespace App\Jobs;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $letter;
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($letter)
    {
        $this->letter = $letter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->letter as $value) {
          try {
            if (!empty($value)) {
                $data = [
                    'title' => $value->title,
                    'email' => $value->email,
                    'content' => $value->content
                ];
                Mail::send('email.index', $data, function($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });
                Log::info('邮件发送成功，发给：'.$value->email);
                Letter::find($value->id)->update(['arrive_status' => 1]);
            }
          } catch (\Exception $e) {
            Log::info('邮件发送失败:'.$e);
          }
        }
    }
}
