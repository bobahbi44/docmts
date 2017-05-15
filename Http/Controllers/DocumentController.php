<?php
namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Repositories\DocumentRepository;

class DocumentController extends Controller
{
    /** @var  DocumentRepository */
    protected $documentRepository;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = $this->documentRepository->getActiveWithUserOrderByDate();
        
        return view('document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $this->documentRepository->store($request->all(), $request->user()->id);
        \Flash::success('Документ успешно сохранен');

        return redirect('document.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = $this->documentRepository->getById($id);
        $this->authorize('change', $document);

        return view('document.edit', $document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function update($id, DocumentRequest $request)
    {
        $document = $this->documentRepository->getById($id);
        $this->authorize('change', $document);

        $this->documentRepository->update($request->all(), $document);
        \Flash::success('Документ успешно изменен');

        return redirect('document.index');

    }
}
