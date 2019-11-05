package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;

@Entity(tableName = "participants_pending", primaryKeys = {"player_id", "event_id"})
public class PendingParticipant {
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "player_id")
    @ColumnInfo(index = true, name = "player_id")
    int playerId;

    @ForeignKey(entity = Event.class, parentColumns = "id", childColumns = "event_id")
    @ColumnInfo(index = true, name = "event_id")
    int eventId;
}
