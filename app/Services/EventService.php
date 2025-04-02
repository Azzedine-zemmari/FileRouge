<?php 

namespace App\Services;

use App\Repositories\Contracts\CategorieInterface;
use App\Repositories\Contracts\EventInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EventService {
    private $eventrepository;
    private $userRepository;
    private $categoryRepository;
    public function __construct(
        EventInterface $eventrepository,
        CategorieInterface $categoryRepository,
        UserRepositoryInterface $userRepository
        )
    {
        $this->eventrepository = $eventrepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function createEvent(array $data){
        $validator = Validator::make($data,[
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'taketPrice' => 'required|numeric|min:0',
            'stockeTicket' => 'required|integer|min:1',
            'numberOfPlace' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'artistId' => ['required',Rule::exists('users','id')->where('role','artist')],
            'categorieId' => 'required|exists:categories,id',
            'place' => 'required|string'
        ]);

        if($validator->fails()){
            throw new ValidationException($validator);
        }

        if(isset($data['image'])){
            $image = $data['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads',$imageName);
            $data['image'] = "storage/uploads/$imageName"; // store it in db;
        }

        return $this->eventrepository->create($data);
    }
    public function getCategories(){
        return $this->categoryRepository->getAll();
    }
    public function getArtists(){
        return $this->userRepository->findByRole('artist');
    }
}