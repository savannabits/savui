@php echo "<?php"
@endphp


namespace App\Http\Requests\Web\{{ $modelWithNamespaceFromDefault }};

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BulkDestroy{{ $modelBaseName }} extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * {{'@'}}return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('{{ $modelDotNotation }}.bulk-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * {{'@'}}return array
     */
    public function rules(): array
    {
        return [
            'ids.*' => 'integer'
        ];
    }
}
