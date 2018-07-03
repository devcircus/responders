<?php

namespace BrightComponents\Responder;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use DevMarketer\LaraFlash\LaraFlash;
use Illuminate\View\Factory as View;
use Illuminate\Routing\ResponseFactory as Response;

abstract class Responder
{
    /**
     * The response payload.
     *
     * @var mixed
     */
    protected $payload;

    /**
     * View factory for returning views.
     *
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Session store for interacting with session.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * Response factory for generating responses.
     *
     * @var /Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;

    /**
     * Redirector for generating redirects.
     *
     * @var \Illuminate\Routing\Redirector
     */
    protected $redirector;

    /**
     * Laraflash for flashing to session.
     *
     * @var \DevMarketer\LaraFlash\LaraFlash
     */
    protected $flash;

    /**
     * Construct a new base Responder.
     *
     * @param  \Illuminate\View\Factory $view
     * @param  \Illuminate\Contracts\Routing\ResponseFactory $response
     * @param  \DevMarketer\LaraFlash\LaraFlash $flash
     * @param  \Illuminate\Routing\Redirector $redirector
     */
    public function __construct(View $view, Response $response, LaraFlash $flash, Redirector $redirector)
    {
        $this->view = $view;
        $this->flash = $flash;
        $this->response = $response;
        $this->redirector = $redirector;
    }

    /**
     * Send a response.
     *
     * @return mixed
     */
    abstract public function respond();

    /**
     * Add the payload to the response.
     *
     * @param  mixed  $payload
     *
     * @return $this
     */
    public function withPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Send a view response.
     *
     * @param  string  $view
     * @param  array  $data
     * @param  array $mergeData
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function view($view, $data = [], $mergeData = [])
    {
        return $this->view->make($view, $data, $mergeData);
    }

    /**
     * Send a redirect response.
     *
     * @param  string  $path
     * @param  int  $status
     * @param  array $headers
     * @param  bool  $secure
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    protected function redirect(string $path = null, $status = 302, array $headers = [], $secure = null)
    {
        if (is_null($path)) {
            return $this->redirector;
        }

        return $this->redirector->to($path, $status, $headers, $secure);
    }

    /**
     * Flash data to the session.
     *
     * @param  string $key
     * @param  mixed  $value
     */
    protected function flash($message, array $options = [])
    {
        return $this->flash->add($message, $options);
    }

    /**
     * Send a json response.
     *
     * @param  mixed  $content
     * @param  int  $status
     * @param  array  $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function json($content = '', $status = 500, array $headers = [])
    {
        return $this->response->json($content, $status, $headers);
    }
}
