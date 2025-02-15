<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepresenterRequest;
use App\Http\Requests\UpdatepresenterRequest;
use App\Repositories\presenterRepository;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\user_employee;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Flash;
use Response;

class presenterController extends AppBaseController
{
    /** @var presenterRepository $presenterRepository*/
    private $presenterRepository;

    public function __construct(presenterRepository $presenterRepo)
    {
        $this->presenterRepository = $presenterRepo;
    }

    /**
     * Display a listing of the presenter.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_presenters');
        $presenters = $this->presenterRepository->all();

        return view('presenters.index')
            ->with('presenters', $presenters);
    }

    /**
     * Show the form for creating a new presenter.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_presenters');
        $userEmploye = user_employee::join('employes', 'employes.id', '=', 'user_employees.id_employees')
        ->select('user_employees.id', 'employes.name')
        ->orderby('id')
        ->pluck('name', 'id');
        return view('presenters.create', compact('userEmploye'));
    }

    /**
     * Store a newly created presenter in storage.
     *
     * @param CreatepresenterRequest $request
     *
     * @return Response
     */
    public function store(CreatepresenterRequest $request)
    {
        $input = $request->all();

        $user = User::select('users.*')
            ->join('user_employees', 'users.id', '=', 'user_employees.id_user')
            ->where('user_employees.id', $input['id_users_employees'])
            ->firstOrFail();
    
        $role = Role::where('name', 'presenter_stand')->first();

        $user->syncRoles([$role]);

        $presenter = $this->presenterRepository->create($input);

        $from = [141, 201, 59];
        $to = [20, 166, 222];
        $qrCode = base64_encode(QrCode::format('png')
        ->size(700)
        ->margin(2)
        ->eye('circle')
        ->style('round')
        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'horizontal')
        ->merge('\public\images\cruz.png', 0.05)
        ->errorCorrection('H')
        ->generate($presenter->id));

        $presenter->update(['qr_code' => $qrCode]);
        Flash::success('Presenter saved successfully.');

        return redirect(route('presenters.index'));
    }

    /**
     * Display the specified presenter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_presenters');
        $presenter = $this->presenterRepository->find($id);

        if (empty($presenter)) {
            Flash::error('Presenter not found');

            return redirect(route('presenters.index'));
        }

        return view('presenters.show')->with('presenter', $presenter);
    }

    /**
     * Show the form for editing the specified presenter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_presenters');
        $presenter = $this->presenterRepository->find($id);
        $userEmploye = user_employee::join('employes', 'employes.id', '=', 'user_employees.id_employees')
        ->select('user_employees.id', 'employes.name')
        ->orderby('id')
        ->pluck('name', 'id');
        if (empty($presenter)) {
            Flash::error('Presenter not found');

            return redirect(route('presenters.index'));
        }

        return view('presenters.edit', compact('presenter','userEmploye'));
    }

    /**
     * Update the specified presenter in storage.
     *
     * @param int $id
     * @param UpdatepresenterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepresenterRequest $request)
    {
        $presenter = $this->presenterRepository->find($id);

        $input = $request->all();
        $imagePath = public_path('images/CUMI.jpg');
        //dd($imagePath);
        $from = [141, 201, 59];
        $to = [20, 166, 222];
        $qrCode = base64_encode(QrCode::format('png')
        ->size(700)
        ->margin(2)
        ->eye('circle')
        ->style('round')
        ->errorCorrection('H')
        ->generate($id));
        $input['qr_code'] = $qrCode;
        if (empty($presenter)) {
            Flash::error('Presenter not found');

            return redirect(route('presenters.index'));
        }

        $presenter = $this->presenterRepository->update($input, $id);

        Flash::success('Presenter updated successfully.');

        return redirect(route('presenters.index'));
    }

    /**
     * Remove the specified presenter from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_presenters');
        $presenter = $this->presenterRepository->find($id);

        if (empty($presenter)) {
            Flash::error('Presenter not found');

            return redirect(route('presenters.index'));
        }

        $this->presenterRepository->delete($id);

        Flash::success('Presenter deleted successfully.');

        return redirect(route('presenters.index'));
    }

    public function pending()
    {
        $this->authorize('list_pending');
        return view('presenters.pending');
    }
}
