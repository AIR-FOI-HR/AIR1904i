package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;
import androidx.room.TypeConverters;

import java.util.Date;

import hr.foi.air.database.converters.DateConverter;

@Entity(tableName = "participations", primaryKeys = {"player_id", "event_id"})
@TypeConverters(DateConverter.class)
public class Participation {
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "player_id")
    @ColumnInfo(index = true, name = "player_id")
    int playerId;

    @ForeignKey(entity = Event.class, parentColumns = "id", childColumns = "event_id")
    @ColumnInfo(index = true, name = "event_id")
    int eventId;

    @ForeignKey(entity = Chat.class, parentColumns = "id", childColumns = "chat_id")
    @ColumnInfo(name = "chat_id")
    int chatId;

    @ColumnInfo(name = "join_date")
    Date joinDate;

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

    public int getChatId() {
        return chatId;
    }

    public void setChatId(int chatId) {
        this.chatId = chatId;
    }

    public Date getJoinDate() {
        return joinDate;
    }

    public void setJoinDate(Date joinDate) {
        this.joinDate = joinDate;
    }
}
