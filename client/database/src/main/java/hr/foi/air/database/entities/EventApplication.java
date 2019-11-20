package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;

@Entity(tableName = "applications", primaryKeys = {"player_id", "event_id"})
public class EventApplication {
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "player_id")
    @ColumnInfo(index = true, name = "player_id")
    int playerId;

    @ForeignKey(entity = Event.class, parentColumns = "id", childColumns = "event_id")
    @ColumnInfo(index = true, name = "event_id")
    int eventId;

    public int getPlayerId() {
        return playerId;
    }

    public void setPlayerId(int playerId) {
        this.playerId = playerId;
    }

    public int getEventId() {
        return eventId;
    }

    public void setEventId(int eventId) {
        this.eventId = eventId;
    }
}
