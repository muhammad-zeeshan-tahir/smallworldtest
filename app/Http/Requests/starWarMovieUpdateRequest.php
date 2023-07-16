<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class starWarMovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "title" => 'required|max:255',
            "url"   => 'required|max:255',
            "release_date" => 'required|max:255',
            "director" => 'required|max:255',
            "opening_crawl" => 'required|max:255',
            "episode_id" => 'required|max:20',
            "producer" => 'required|max:255',
            "adult" => 'required|max:255',
            "backdrop_path" => 'required|max:255',
            "language" => 'required|max:10',
            "popularity" => 'required|max:255',
            "poster_path" => 'required|max:255',
            "video" => 'required|max:10',
            "vote_average" => 'required|max:255',
            "vote_count" => 'required|max:255'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            "title" => 'Title',
            "url"   => 'Url',
            "release_date" => 'Release Date',
            "director" => 'Director',
            "opening_crawl" => 'Opening Crawl',
            "episode_id" => 'Episode Id',
            "producer" => 'Producer',
            "adult" => 'Adult',
            "backdrop_path" => 'Backdrop Path',
            "language" => 'Language',
            "popularity" => 'Popularity',
            "poster_path" => 'Poster Path',
            "video" => 'Video',
            "vote_average" => 'Vote Average',
            "vote_count" => 'Vote Count',
            "characters" => 'Characters'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [

        ];
    }
}
