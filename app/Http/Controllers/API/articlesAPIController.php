<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatearticlesAPIRequest;
use App\Http\Requests\API\UpdatearticlesAPIRequest;
use App\Models\articles;
use App\Repositories\articlesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class articlesController
 * @package App\Http\Controllers\API
 */

class articlesAPIController extends AppBaseController
{
    /** @var  articlesRepository */
    private $articlesRepository;

    public function __construct(articlesRepository $articlesRepo)
    {
        $this->articlesRepository = $articlesRepo;
    }

    /**
     * Display a listing of the articles.
     * GET|HEAD /articles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $articles = $this->articlesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    /**
     * Store a newly created articles in storage.
     * POST /articles
     *
     * @param CreatearticlesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatearticlesAPIRequest $request)
    {
        $input = $request->all();

        $articles = $this->articlesRepository->create($input);

        return $this->sendResponse($articles->toArray(), 'Articles saved successfully');
    }

    /**
     * Display the specified articles.
     * GET|HEAD /articles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var articles $articles */
        $articles = $this->articlesRepository->find($id);

        if (empty($articles)) {
            return $this->sendError('Articles not found');
        }

        return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    public function showCode($id)
    {
        /** @var articles $articles */
        $articles = Articles::where('item_code', $id)->first();

        if (empty($articles)) {
            return $this->sendError('Articles not found');
        }

        return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    /**
     * Update the specified articles in storage.
     * PUT/PATCH /articles/{id}
     *
     * @param int $id
     * @param UpdatearticlesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearticlesAPIRequest $request)
    {
        $input = $request->all();

        /** @var articles $articles */
        $articles = $this->articlesRepository->find($id);

        if (empty($articles)) {
            return $this->sendError('Articles not found');
        }

        $articles = $this->articlesRepository->update($input, $id);

        return $this->sendResponse($articles->toArray(), 'articles updated successfully');
    }

    /**
     * Remove the specified articles from storage.
     * DELETE /articles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var articles $articles */
        $articles = $this->articlesRepository->find($id);

        if (empty($articles)) {
            return $this->sendError('Articles not found');
        }

        $articles->delete();

        return $this->sendSuccess('Articles deleted successfully');
    }
}
