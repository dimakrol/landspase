<?php
namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypesRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "POST") {
            return [
                'name' => 'required|string|max:255',
                'code' => 'required|unique:document_type',
            ];
        } elseif ($this->method() == "PUT") {
            return [
                'name' => 'required|string|max:255',
            ];
        } else {
            return [

            ];
        }
    }

    protected function getValidatorInstance()
    {
        if ($this->method() == "POST") {
            $code = getCode($this->get('name'),'alpha');
            $this->merge(['code' => $code]);
        }
        return parent::getValidatorInstance();
    }


}
