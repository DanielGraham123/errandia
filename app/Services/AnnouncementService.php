<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\UserAnnouncement;
use Illuminate\Support\Facades\DB;

class AnnouncementService
{
    public static function find_all($user)
    {
        return DB::table('announcements')
        ->leftJoin('user_announcements',  'announcements.id' , '=', 'announcement_id')
            ->where('published', '=', true)
           ->WhereRaw('announcements.id not in (select c.announcement_id from user_announcements c where  c.user_id = '. $user->id . ' AND c.deleted = true )')
            ->select('announcements.*', 'user_id', 'announcement_id')
            ->paginate(10);
    }

    public static function load($announcement_id)
    {
        $announcement =  Announcement::find($announcement_id);
        if(!$announcement) {
            throw new \Exception('record not found');
        }
        return $announcement;
    }

    public static function make_as_read($user_id, $announcement_id): void
    {
        self::load($announcement_id);

        if(!UserAnnouncement::where(
            'user_id', $user_id
        )->where('announcement_id', $announcement_id)->first()){
            UserAnnouncement::create([
                'user_id' => $user_id,
                'announcement_id' => $announcement_id,
            ]);
        }
    }

    public static function make_as_deleted($user_id, $announcement_id): void
    {
        UserAnnouncement::where([
            'user_id' =>  $user_id,
            'announcement_id' =>  $announcement_id,
        ])->update([
            'deleted' => true
        ]);
    }
}