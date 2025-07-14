<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property \App\Models\Article $article
 */
class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'=> 'required|string|max:255|unique:articles,title,' . $this->article->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'is_commentable' => 'boolean',
            'is_shareable' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
        ];
    }
}