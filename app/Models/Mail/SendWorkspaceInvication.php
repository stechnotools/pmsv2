<?php

namespace App\Models\Mail;

use App\Models\User;
use App\Models\Utility;
use App\Models\Workspace;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWorkspaceInvication extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $workspace;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Workspace $workspace)
    {
        $this->user = $user;
        $this->workspace = $workspace;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $setting = Utility::getAdminPaymentSettings();
        return $this->markdown('email.workspace_invitation')->subject('New Workspace Invitation - '.  $setting['app_name'] ? $setting['app_name'] : 'PMS');
    }
}
