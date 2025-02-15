<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemedicationTemplateRequest;
use App\Http\Requests\UpdatemedicationTemplateRequest;
use App\Repositories\medicationTemplateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Invima_registration;
use App\Models\medicationTemplate;

class medicationTemplateController extends AppBaseController
{
    /** @var medicationTemplateRepository $medicationTemplateRepository*/
    private $medicationTemplateRepository;

    public function __construct(medicationTemplateRepository $medicationTemplateRepo)
    {
        $this->medicationTemplateRepository = $medicationTemplateRepo;
    }

    /**
     * Display a listing of the medicationTemplate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $templateQuery = medicationTemplate::query();

        if (!empty($search)) {
            $templateQuery->where('template_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('concentrationt', 'LIKE', '%' . $search . '%')
                        ->orWhere('presentationt', 'LIKE', '%' . $search . '%')
                        ->orWhere('received_amountt', 'LIKE', '%' . $search . '%')
                        ->orWhere('samplet', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('invima_registration', function ($query) use ($search) {
                            $query->where('generic_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('tradename', 'LIKE', '%' . $search . '%')
                            ->orWhere('health_register', 'LIKE', '%' . $search . '%')
                            ->orWhere('state_invima', 'LIKE', '%' . $search . '%')
                            ->orWhere('pharmaceutical_form', 'LIKE', '%' . $search . '%');
                        });
        }

        $medicationTemplates = $templateQuery->paginate($perPage);

        return view('medication_templates.index', compact('medicationTemplates'));
    }

    /**
     * Show the form for creating a new medicationTemplate.
     *
     * @return Response
     */
    public function create()
    {
        $invimas = Invima_registration::all();
        return view('medication_templates.create', compact('invimas'));
    }

    /**
     * Store a newly created medicationTemplate in storage.
     *
     * @param CreatemedicationTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreatemedicationTemplateRequest $request)
    {
        $input = $request->all();
        $medicationTemplate = $this->medicationTemplateRepository->create($input);

        session()->flash('success', "¡¡Plantilla creada con éxito!!");

        return redirect(route('medicationTemplates.index'));
    }

    /**
     * Display the specified medicationTemplate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            Flash::error('Medication Template not found');

            return redirect(route('medicationTemplates.index'));
        }

        return view('medication_templates.show')->with('medicationTemplate', $medicationTemplate);
    }

    /**
     * Show the form for editing the specified medicationTemplate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicationTemplate = $this->medicationTemplateRepository->find($id);
        $invimas = Invima_registration::all();
        $invimasSelect = Invima_registration::where('id', $medicationTemplate->invima_registrations_id)->get();
        if (empty($medicationTemplate)) {
            Flash::error('Medication Template not found');

            return redirect(route('medicationTemplates.index'));
        }
        

        return view('medication_templates.edit', compact('invimas', 'invimasSelect', 'medicationTemplate'));
    }

    /**
     * Update the specified medicationTemplate in storage.
     *
     * @param int $id
     * @param UpdatemedicationTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemedicationTemplateRequest $request)
    {
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            Flash::error('Medication Template not found');

            return redirect(route('medicationTemplates.index'));
        }

        $medicationTemplate = $this->medicationTemplateRepository->update($request->all(), $id);

        session()->flash('success', "¡¡Plantilla modificada con éxito!!");

        return redirect(route('medicationTemplates.index'));
    }

    /**
     * Remove the specified medicationTemplate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            Flash::error('Medication Template not found');

            return redirect(route('medicationTemplates.index'));
        }

        $this->medicationTemplateRepository->delete($id);

        Flash::success('Medication Template deleted successfully.');

        return redirect(route('medicationTemplates.index'));
    }
}
