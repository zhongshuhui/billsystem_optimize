<?php

namespace App\Jobs;

use App\Services\AudioProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * podcast 实例
     *
     * @var \App\Models\Podcast
     */
    protected $podcast;

    /**
     * 创建一个新的任务实例
     *
     * @param  $podcast
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * 运行任务
     *
     * @param  $processor
     * @return void
     */
    public function handle(AudioProcessor $processor)
    {
        // 处理上传的 podcast...
        echo '上传的 podcast';
    }


    /**
     * 获取一个可以被传递通过的中间件任务。
     *
     * @return array
     */
    public function middleware()
    {
        echo ' 我是任务中间件';
        return [new RateLimited('backups')];
    }

    /**
     * 处理任务失败。
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        // 向用户发送失败通知等......
        echo '任务失败啦';
    }
}
