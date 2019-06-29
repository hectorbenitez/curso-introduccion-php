<?php


namespace App\Controllers;


class ProfileController extends BaseController
{
    public function changePassword() {
        return $this->renderHTML('admin/profile/changePassword.twig');
    }
}