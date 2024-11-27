<?php

namespace App\Http\Controllers\Dashboard\Chats;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Chats\ChatsRequest;
use App\Http\Services\Dashboard\Ads\AdsService;
use App\Repository\ChatRoomRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\QualificationRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    private CompanyRepositoryInterface $companyRepository;
    private SeekerRepositoryInterface $seekerRepository;
    private ChatRoomRepositoryInterface $chatRoomRepository;


    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        SeekerRepositoryInterface $seekerRepository,
        ChatRoomRepositoryInterface $chatRoomRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->companyRepository = $companyRepository;
        $this->seekerRepository = $seekerRepository;
        $this->chatRoomRepository = $chatRoomRepository;
    }

    public function index() {
        $companies = $this->companyRepository->getAll(['id', 'user_id'], ['user']);
        $seekers = $this->seekerRepository->getAll(['id', 'user_id'], ['user']);
//        $room = $this->chatRoomRepository->getById($roomId);
        return view('dashboard.site.chats.index', ['companies' => $companies, 'seekers' => $seekers]);
    }

    public function search(ChatsRequest $request) {
        $search = $this->chatRoomRepository->search($request->company_id, $request->seeker_id);
        return $search->exists()
            ? redirect()->route('chats.get', $search->first()->id)
            : redirect()->route('chats.index')->with(['error' => __('messages.No chat found with these users')]);
    }

    public function get($roomId) {
        $companies = $this->companyRepository->getAll(['id', 'user_id'], ['user']);
        $seekers = $this->seekerRepository->getAll(['id', 'user_id'], ['user']);
        $room = $this->chatRoomRepository->getById($roomId);
        $roomUsers = $room->users()->pluck('user_id')->toArray();
        return view('dashboard.site.chats.index', ['companies' => $companies, 'seekers' => $seekers, 'room' => $room, 'roomUsers' => $roomUsers]);
    }
}
