<?php


namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers\DocumentTypeChecker;

class UserCreatingEvent extends Event
{

    use SerializesModels;

    public $user;
    private $documentTypeChecker;

    /**
     * Create a new event instance.
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->documentTypeChecker = new DocumentTypeChecker();

        $this->user->setAttribute('password', Hash::make($user->password));
        $this->user->setAttribute('type', $this->documentTypeChecker->getDocumentType($user->document));
    }

}
