<?php namespace Ill\System\Base;

use Ill\Core\CommandBus\DefaultCommandBus;
use Illuminate\Routing\Controller, View, Hash;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller
{
    protected $layout = 'layouts.master';
    protected $currentUser;
    protected $title = '';
    protected $bus;

    public function __construct(DefaultCommandBus $bus)
    {

        $this->bus = $bus;

    }

    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }

        $this->currentUser = \Auth::user();
        View::share('currentUser', $this->currentUser);
    }

    protected function view($path, $data = [])
    {
        $this->layout->title = $this->title;
        $this->layout->content = View::make($path, $data);
    }

    protected function redirectTo($url, $statusCode = 302)
    {
        return Redirect::to($url, $statusCode);
    }

    protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

    protected function redirectRoute($route, $data = [])
    {
        return Redirect::route($route, $data);
    }

    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    protected function redirectIntended($default = null)
    {
        $intended = Session::get('auth.intended_redirect_url');
        if ($intended) {
            return $this->redirectTo($intended);
        }
        return Redirect::to($default);
    }
}
