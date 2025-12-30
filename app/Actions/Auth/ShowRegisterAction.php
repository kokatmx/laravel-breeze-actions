<?php

namespace App\Actions\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowRegisterAction
{
    use AsAction;

    public function handle(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function asController(): Response
    {
        return $this->handle();
    }
}
