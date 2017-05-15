<?php
namespace App\Repositories;

use App\Models\Document;

class DocumentRepository extends BaseRepository
{

    /**
     * Create a new DocumentRepository instance.
     *
     * @param  \App\Models\Document $document
     */
    public function __construct(Document $document)
    {
        $this->model = $document;
    }

    /**
     * Create or update a document.
     *
     * @param  \App\Models\Document $document
     * @param  array  $inputs
     * @param  integer  $user_id
     * @return \App\Models\Document
     */
    protected function saveDocument($document, $inputs, $user_id = null)
    {
        $document->subdivision_id = $inputs['subdivision_id'];
        $document->date = $inputs['date'];
        $document->document_category = $inputs['document_category'];
        $document->shift = $inputs['shift'];
        $document->active = isset($inputs['active']);
        if ($user_id) {
            $document->user_id = $user_id;
        }
        $document->save();

        return $document;
    }

    /**
     * Update a document.
     *
     * @param  array  $inputs
     * @param  \App\Models\Document $document
     * @return void
     */
    public function update($inputs, $document)
    {
        $this->saveDocument($document, $inputs);
    }

    /**
     * Create a document.
     *
     * @param  array  $inputs
     * @param  int    $user_id
     * @return void
     */
    public function store($inputs, $user_id)
    {
        $this->saveDocument(new $this->model, $inputs, $user_id);
    }

    /**
     * Get document collection.
     *
     * @return Illuminate\Support\Collection
     */
    public function getActiveWithUserOrderByDate() {

        return $this->queryActiveWithUserOrderByDate()->paginate();
    }

    /**
     * Create a query for Documents.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->active(true)
            ->with('user')
            ->latest();
    }
}
