package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;
import androidx.room.PrimaryKey;
import androidx.room.TypeConverters;

import java.util.Date;

import hr.foi.air.database.converters.DateConverter;

@Entity(tableName = "messages")
@TypeConverters(DateConverter.class)
public class Message {
    @PrimaryKey(autoGenerate = true)
    int id;
    @ForeignKey(entity = Chat.class, parentColumns = "id", childColumns = "chat_id")
    @ColumnInfo(index = true, name = "chat_id")
    String chatId;
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "sender_id")
    @ColumnInfo(index = true, name = "sender_id")
    int SenderId;
    @ColumnInfo(name = "send_time")
    Date sendTime;

    String text;
}
