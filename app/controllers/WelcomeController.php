<?php

namespace App\Controllers;

use App\Core\Parsedown;

class WelcomeController
{
    protected $pageTitle;

    public function __construct()
    {
        $updateDirs = array_diff(scandir('app/views/update/'), array('.', '..'));
        $latestDir = end($updateDirs);

        if (empty($_SESSION['VERSION'])) {
            $_SESSION['VERSION'] = $latestDir;
        }

        $this->folder = 'app/views/update/' . $_SESSION['VERSION'];
        $this->pd = new Parsedown();
    }

    public function whatsNew()
    {
        $pageTitle = "Whats new?";

        $mdContent = file_get_contents($this->folder . '/whats-new.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function introduction()
    {
        $pageTitle = "Introduction";

        $mdContent = file_get_contents($this->folder . '/introduction.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function upgradeGuide()
    {
        $pageTitle = "Upgrade";

        $mdContent = file_get_contents($this->folder . '/upgrade.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function installation()
    {
        $pageTitle = "Installation";

        $mdContent = file_get_contents($this->folder . '/installation.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function fileStructure()
    {
        $pageTitle = "File Structure";

        $mdContent = file_get_contents($this->folder . '/file-structure.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function authentication()
    {
        $pageTitle = "Authentication";

        $mdContent = file_get_contents($this->folder . '/authentication.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function registration()
    {
        $pageTitle = "Registration";

        $mdContent = file_get_contents($this->folder . '/registration.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function databases()
    {
        $pageTitle = "Database";

        $mdContent = file_get_contents($this->folder . '/database.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function routing()
    {
        $pageTitle = "Routing";

        $mdContent = file_get_contents($this->folder . '/routing.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function controllers()
    {
        $pageTitle = "Controllers";

        $mdContent = file_get_contents($this->folder . '/controllers.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function views()
    {
        $pageTitle = "Views";

        $mdContent = file_get_contents($this->folder . '/views.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function helpers()
    {
        $pageTitle = "Function Helpers";

        $mdContent = file_get_contents($this->folder . '/helpers.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function alerts()
    {
        $pageTitle = "Alert Messages";

        $mdContent = file_get_contents($this->folder . '/alerts.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function argonTemplate()
    {
        $pageTitle = "Argon Template";

        $mdContent = file_get_contents($this->folder . '/argon-template.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function migration()
    {
        $pageTitle = "Database Migration";

        $mdContent = file_get_contents($this->folder . '/migration.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function credits()
    {
        $pageTitle = "Thanks to";

        return view($this->folder . 'credits', compact('pageTitle'));
    }

    public function email()
    {
        $pageTitle = "E-mail";

        $mdContent = file_get_contents($this->folder . '/email.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function csrf()
    {
        $pageTitle = "Csrf";

        $mdContent = file_get_contents($this->folder . '/csrf.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function validation()
    {
        $pageTitle = "Validation";

        $mdContent = file_get_contents($this->folder . '/validation.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function admintyTemplate()
    {
        $pageTitle = "Adminty Template";

        $mdContent = file_get_contents($this->folder . '/adminty-template.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function adminlteTemplate()
    {
        $pageTitle = "Adminlte Template";

        $mdContent = file_get_contents($this->folder . '/adminlte-template.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function deployment()
    {
        $pageTitle = "deployment";

        $mdContent = file_get_contents($this->folder . '/deployment.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }

    public function fortify()
    {
        $pageTitle = "Fortify";

        $mdContent = file_get_contents($this->folder . '/fortify.md');
        $data = $this->pd->text($mdContent);

        return view('home', compact('pageTitle', 'data'));
    }
}
