<?php
namespace App\Http\Requests;

class DocumentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subdivision_id' => 'required|exists,subdivisions,id',
            'date' => 'required|date',
            'document_category' => 'required|exists:document_category,id',
            'shift' => 'required|in:1,2',
            'active' => 'required|boolean',
        ];
    }
}