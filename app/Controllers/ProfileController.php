<?php


namespace App\Controllers;


use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class ProfileController extends BaseController
{
    public function changePassword() {
        $flash = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $this->renderHTML('admin/profile/changePassword.twig', [
            'flash' => $flash
        ]);
    }

    public function savePassword(ServerRequest $request) {
        $postData = $request->getParsedBody();

        if ($postData['password1']) {
            $currentUser = User::find($_SESSION['userId']);
            if (password_verify($postData['password'], $currentUser->password)) {
                if ($postData['password1'] === $postData['password2'])
                {
                    $_SESSION['flash']['message'] = 'Password changed successfully';
                    $currentUser->password = password_hash($postData['password1'], PASSWORD_DEFAULT);
                    $currentUser->save();
                } else {
                    $_SESSION['flash']['error'] = 'Password confirm does not match';
                }
            } else {
                $_SESSION['flash']['error'] = 'Current password is wrong';
            }
        } else {
            $_SESSION['flash']['error'] = 'New password should not be empty';
        }

        return new RedirectResponse('/admin/profile/changePassword');
    }
}