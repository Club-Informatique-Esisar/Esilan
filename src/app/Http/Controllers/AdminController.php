<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Esilan;
use App\Game;
use App\Page;
use App\TicketType;
use App\Ticket;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Utils\ImageLibrary\ImageLibrary;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /****************************************
     * FAQ
     */
    public function faqShow(){
        $faq = Page::where('name','faq')->first();
        return view('admin.faq', array('faq' => $faq));
    }

    public function faqUpdate(Request $request){
        // On part pour l'instant du principe que les entrées sont juste.
        $faq = Page::where('name','faq')->first();
        $faq->desc = $request->descFAQ;
        $faq->save();
        return redirect('/admin/faq');
    }


    /****************************************
     * ESILAN
     */
    public function esilanDisplay(){
        $esilans = Esilan::orderBy("beginDate", "desc")->get();
        return view('admin.esilan.display', array('esilans' => $esilans));
    }

    public function esilanShow($id){
        if ($id == "new"){
            $esilan = new Esilan();
            $esilan->ticketTypes[] = new TicketType();
            $esilan->beginDate = (new \DateTime("today 19:00"))->format("Y-m-d H:i:s");
            $esilan->endDate = (new \DateTime("tomorrow 7:00"))->format("Y-m-d H:i:s");
            $opt = "create";
        } else {
            $opt = "update";
            $esilan = Esilan::findOrFail($id);
        }
        return view('admin.esilan.show', array('esilan' => $esilan, 'opt' => $opt));
    }

    public function esilanAddOrUpdate(Request $request){
        // On part pour l'instant du principe que les entrées sont juste.

        $ticketTypes = $request->ticketTypes;
        if ($request->commande == "create"){
            $esilan = new Esilan;
            $esilan->name = $request->titleEsilan;
            $esilan->desc = $request->descEsilan;
            $esilan->beginDate = Carbon::createFromFormat('Y-m-d H:i',$request->beginDate." ".$request->beginTime);
            $esilan->endDate = Carbon::createFromFormat('Y-m-d H:i',$request->endDate." ".$request->endTime);

            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $ext = $request->img->getClientOriginalExtension();
                $imgName = "esilanAffiche_" . time();
                ImageLibrary::writeFile($request->file('img'), $imgName, $ext);
                $esilan->imgName = $imgName.".".$ext;
            }

            $esilan->save();
            
            foreach ($ticketTypes as $ticketType) {
                $newTicket = new TicketType();
                $newTicket->name = $ticketType['ticketTypeName'];
                $newTicket->desc = $ticketType['ticketTypeDesc'];
                $newTicket->price = $ticketType['ticketTypePrice'];
                $newTicket->maxTicket = $ticketType['ticketTypeMax'];
                $esilan->ticketTypes()->save($newTicket);
            }
        } else if ($request->commande == "update"){
            $idEsilan = $request->idEsilan;
            $updateEsilan = Esilan::find($idEsilan);
            $updateEsilan->name = $request->titleEsilan;
            $updateEsilan->desc = $request->descEsilan;

            $updateEsilan->beginDate = Carbon::createFromFormat('Y-m-d H:i',$request->beginDate." ".$request->beginTime);
            $updateEsilan->endDate = Carbon::createFromFormat('Y-m-d H:i',$request->endDate." ".$request->endTime);

            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $ext = $request->img->getClientOriginalExtension();
                $imgName = "esilanAffiche_" . time();
                ImageLibrary::writeFile($request->file('img'), $imgName, $ext);
                $updateEsilan->imgName = $imgName.".".$ext;
            }

            $updateEsilan->save();
            foreach ($ticketTypes as $ticketType) {
                $idTicketType = $ticketType['id'];
                $updateTicket = TicketType::find($idTicketType);
                $updateTicket->name = $ticketType['ticketTypeName'];
                $updateTicket->desc = $ticketType['ticketTypeDesc'];
                $updateTicket->price = $ticketType['ticketTypePrice'];
                $updateTicket->maxTicket = $ticketType['ticketTypeMax'];
                $updateTicket->save();
            }
        } else if ($request->commande == "remove") {
            // TODO: Se mettre d'accord sur une politique de suppression
        }
                
        return redirect('/admin/esilan');
    }

    /****************************************
     * SALES
     */

    public function ticketDisplay(Request $request){
        $esilans = Esilan::orderBy('beginDate', 'desc')->get();
        $idEsilan = $request->input('idEsilan', '-1');
        $esilan = Esilan::find($idEsilan);
        if ($esilan == null){
            $esilan = Esilan::orderBy('beginDate', 'desc')->first();
        }

        return view('admin.sales.display', array('esilans' => $esilans, "esilanChoosed" => $esilan));

    }


    /****************************************
     * AJAX
     */
    public function ajaxTicketValidation(Request $request){
        $idTicket = $request->input('idTicket', '-1');
        $ticketToValidate = Ticket::find($idTicket);
        if ($ticketToValidate == null) {
            return response('Ticket inconnu', 400);
        }
        $ticketToValidate->dateValidation = Carbon::now();
        $ticketToValidate->validator = Auth::user()->id;
        $ticketToValidate->save();

        return response()->json([
            'nameValidator' => ($ticketToValidate->userValidator->name),
            'dateValidation' => ($ticketToValidate->dateValidation->formatLocalized("%A %e %B %Y")),
            'timeValidation' => ($ticketToValidate->dateValidation->formatLocalized(" %T"))
        ]);
    }

    public function typeTourCompatDisable(Request $request){
        $idTicketType = $request->input('idTicketType', '-1');
        $ticketType = TicketType::find($idTicketType);
        $idTournament = $request->input('idTournament', '-1');
        $tournament = Tournament::find($idTournament);
        if (($ticketType != null) && ($tournament != null)){
            $tournament->compatibilities()->detach($idTicketType);
            return response("OK");
        } else {
            return response("NOK", 400);
        }
    }

    public function typeTourCompatEnable(Request $request){
        $idTicketType = $request->input('idTicketType', '-1');
        $ticketType = TicketType::find($idTicketType);
        $idTournament = $request->input('idTournament', '-1');
        $tournament = Tournament::find($idTournament);
        if (($ticketType != null) && ($tournament != null)){
            $tournament->compatibilities()->attach($idTicketType);
            return response("OK");
        } else {
            return response("NOK", 400);
        }
    }

    public function ajaxEsilanImgName(Request $request){
        $esilan = Esilan::findOrFail($request->input('idEsilan', '-1'));
        return response()->json(["imgName" => $esilan->fullImgPathOrDefault()]);
    }
    public function ajaxGameImgName(Request $request){
        $game = Game::findOrFail($request->input('idGame', '-1'));
        return response()->json(["imgName" => $game->fullImgPathOrDefault()]);
    }
    /****************************************
     * GAMES
     */
    public function gamesDisplay(){
        $games = Game::all();
        return view('admin.games.display', array('games' => $games));
    }

    public function gameShow($id){
        if ($id == "new"){
            $game = new Game();
            $opt = "create";
        } else {
            $game = Game::findOrFail($id);
            $opt = "update";
        }
        return view('admin.games.show', array('game' => $game, 'opt' => $opt));
    }

    public function gameAddOrUpdate(Request $request){
        // On part pour l'instant du principe que les entrées sont juste.

        if ($request->commande == "create"){
            $game = new Game;
            $game->name = $request->titleGame;
            $game->desc = $request->descGame;

            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $ext = $request->img->getClientOriginalExtension();
                $imgName = "jeuAffiche_" . time();
                ImageLibrary::writeFile($request->file('img'), $imgName, $ext);
                $game->imgName = $imgName.".".$ext;
            }
            $game->save();

        } else if ($request->commande == "update"){
            $idGame = $request->idGame;
            $updateGame = Game::find($idGame);
            $updateGame->name = $request->titleGame;
            $updateGame->desc = $request->descGame;

            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $ext = $request->img->getClientOriginalExtension();
                $imgName = "jeuAffiche_" . time();
                ImageLibrary::writeFile($request->file('img'), $imgName, $ext);
                $updateGame->imgName = $imgName.".".$ext;
            }

            $updateGame->save();
        } else if ($request->commande == "remove") {
            // TODO: Se mettre d'accord sur une politique de suppression
        }
                
        return redirect('/admin/games');
    }

    /****************************************
     * TOURNAMENTS
     */
    public function tournamentsDisplay(Request $request){
        $esilans = Esilan::orderBy('beginDate','desc')->get();
        $idEsilan = $request->idEsilan;
        $esilan = Esilan::find($idEsilan);

        return view('admin.tournaments.display', array('esilans' => $esilans, 'esilan' => $esilan));
    }

    public function tournamentShow(Request $request, $id){
        $idEsilan = $request->idEsilan;
        $esilanPreselected = Esilan::find($idEsilan);
        $idGame = $request->idGame;
        $gamePreselected = Game::find($idGame);

        $gamesArray = Game::orderBy('name', 'asc')->get();
        $esilanArray = Esilan::orderBy('beginDate', 'desc')->get();

        if ($id == "new"){
            $tournament = new Tournament();
            $tournament->beginDate = Carbon::now();
            $tournament->endDate = Carbon::now();
            $opt = "create";
        } else {
            $tournament = Tournament::findOrFail($id);
            $opt = "update";
        }
        return view('admin.tournaments.show', array(
            'tournament' => $tournament,
            'opt' => $opt,
            'esilanArray' => $esilanArray,
            'gamesArray' => $gamesArray,
            'esilanPreselected' => $esilanPreselected,
            'gamePreselected' => $gamePreselected, ));
    }
    
    public function tournamentAddOrUpdate(Request $request){
        // On part pour l'instant du principe que les entrées sont juste.

        if ($request->commande == "create"){
            $tournament = new Tournament();
            $tournament->name = $request->titletournament;
            $tournament->beginDate = Carbon::createFromFormat('Y-m-d H:i',$request->beginDate." ".$request->beginTime);
            $tournament->endDate = Carbon::createFromFormat('Y-m-d H:i',$request->endDate." ".$request->endTime);
            $tournament->esilan()->associate($request->idEsilanTournament);
            $tournament->game()->associate($request->idGameTournament);

            if ($request->inputSwitchImg == "game_img") {
                $game = Game::find($request->idGameTournament);
                $tournament->imgName = $game->imgName;
            } else if ($request->inputSwitchImg == "own_img" && $request->hasFile('imgTournament') && $request->file('imgTournament')->isValid()) {
                $ext = $request->imgTournament->getClientOriginalExtension();
                $imgName = "tournamentAffiche" . time();
                ImageLibrary::writeFile($request->file('imgTournament'), $imgName, $ext);
                $tournament->imgName = $imgName.".".$ext;
            }

            $tournament->save();

        } else if ($request->commande == "update"){
            $idTournament = $request->idTournament;
            $tournament = Tournament::find($idTournament);
            $tournament->name = $request->titletournament;
            $tournament->beginDate = Carbon::createFromFormat('Y-m-d H:i',$request->beginDate." ".$request->beginTime);
            $tournament->endDate = Carbon::createFromFormat('Y-m-d H:i',$request->endDate." ".$request->endTime);

            if ($request->inputSwitchImg == "game_img") {
                $game = Game::find($request->idGameTournament);
                $tournament->imgName = $game->imgName;
            } else if ($request->inputSwitchImg == "own_img" && $request->hasFile('imgTournament') && $request->file('imgTournament')->isValid()) {
                $ext = $request->imgTournament->getClientOriginalExtension();
                $imgName = "tournamentAffiche" . time();
                ImageLibrary::writeFile($request->file('imgTournament'), $imgName, $ext);
                $tournament->imgName = $imgName.".".$ext;
            }
            
            $tournament->save();

            $tournament->game()->associate($request->idGameTournament);
            
        } else if ($request->commande == "remove") {
            // TODO: Se mettre d'accord sur une politique de suppression
        }
                
        return redirect('/admin/tournaments?idEsilan'.$tournament->idEsilan);
    }


    
    /****************************************
     * GAMES
     */
    public function gamersDisplay(Request $request){
        $search = $request->input("s");
        if ($search == null){
            $search = "";
        }
        
        $gamers = User::orderBy('name','asc')
        ->where('name', 'LIKE', '%'.$search.'%')
        // ->orWhere('username', 'like', $search)
        ->orWhere('email', 'LIKE', "%".$search."%")
        ->paginate(15);
        $numPages = User::count();

        return view('admin.gamers.display', array('gamers' => $gamers, "searchValue" => $search));
    }

    public function gamersShow($id){
        $roleArray = User::getRoleAsArray();

        $user = User::findOrFail($id);

        return view('admin.gamers.show', array(
            'user' => $user,
            'roleArray' => $roleArray));
    }

    public function gamerUpdate(Request $request){
        // On part pour l'instant du principe que les entrées sont juste.

        $idUser = $request->idUser;
        $user = User::find($idUser);
        $user->role = $request->role;
        $user->save();
               
        return redirect('/admin/gamers');
    }

}
