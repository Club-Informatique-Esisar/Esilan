<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Esilan;
use App\TicketType;
use App\Ticket;
use App\TournamentParticipation;
use \DateTime;

class TicketController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function buyPlace($idEsilan, $ticketTypeName)
    {
        $esilan = Esilan::find($idEsilan);
        $ticketType = TicketType::where('idEsilan', $idEsilan)->where('name', $ticketTypeName)->first();

        if ($esilan == null || $ticketType == null){
            return redirect('/esilan');
        } else if (Auth::user()->isRegisterToEsilan($esilan->id)){
            return redirect("/esilan/$esilan->id");
        } else {
            return view('esilan.buyPlace.validateCommand',array('esilan' => $esilan, 'ticketType' => $ticketType));
        }
    }

    public function editPlace($idEsilan, $ticketTypeName)
    {
        $esilan = Esilan::find($idEsilan);
        $ticketType = TicketType::where('idEsilan', $idEsilan)->where('name', $ticketTypeName)->first();

        
        if ($esilan == null || $ticketType == null){
            return redirect('/esilan');
        } else if (!Auth::user()->ownTicketType($ticketType->id)){
            return redirect("/esilan/$esilan->id");
        } else {
            return view('esilan.buyPlace.editCommand',array('esilan' => $esilan, 'ticketType' => $ticketType));
        }
    }

    public function deletePlace($idEsilan, $ticketTypeName)
    {
        // TODO : User must not delete place validated by admin
        $esilan = Esilan::find($idEsilan);
        $ticketType = TicketType::where('idEsilan', $idEsilan)->where('name', $ticketTypeName)->first();

        if ($esilan == null || $ticketType == null){
            return redirect('/esilan');
        } else if (!Auth::user()->ownTicketType($ticketType->id)){
            return redirect("/esilan/$esilan->id");
        } else {
            // TODO : Check if there is no security issues since there is no verification
            // Delete all participation of player to tournament
            foreach ($ticketType->tournaments as $tournament) {
                DB::table('tournament_participations')->where([
                    ['idGamer', '=', Auth::user()->id],
                    ['idTournament', '=', $tournament->id],
                ])->delete();
            }
            DB::table('tickets')->where([
                ['idGamer', '=', Auth::user()->id],
                ['idTicketType', '=', $ticketType->id],
            ])->delete();
            return redirect("/esilan/$esilan->id");
        }
    }

    /**
     * Call from /commande route
     */
    public function validateCommand(Request $request){
        // TODO: Add validator
        $id_ticketType = $request->input('ticketType');
        $id_tournaments = $request->input('tournaments');

        $newTicket = new Ticket();
        $newTicket->dateCreation = new DateTime();
        $newTicket->idGamer = Auth::user()->id;
        $newTicket->idTicketType = $id_ticketType;
        $esilan = $newTicket->ticketType->esilan;
        
        if (Auth::user()->isRegisterToEsilan($newTicket->ticketType->esilan->id)){
            return redirect('/esilan');
        } else {
            $newTicket->save();
            $participations = array();

            foreach((array) $id_tournaments as $idTournament){
                $newParticipation = new TournamentParticipation();
                $newParticipation->idGamer = Auth::id();
                $newParticipation->idTournament = $idTournament;
                $newParticipation->save();
                $participations[] = $newParticipation;
            }
            return view('esilan.buyPlace.checkCommand', array('esilan'=>$esilan, 'ticket' => $newTicket, 'participations' => $participations));
        }


    }

}
