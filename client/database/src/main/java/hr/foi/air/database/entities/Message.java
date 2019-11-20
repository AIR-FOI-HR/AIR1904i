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

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getChatId() {
        return chatId;
    }

    public void setChatId(String chatId) {
        this.chatId = chatId;
    }

    public int getSenderId() {
        return SenderId;
    }

    public void setSenderId(int senderId) {
        SenderId = senderId;
    }

    public Date getSendTime() {
        return sendTime;
    }

    public void setSendTime(Date sendTime) {
        this.sendTime = sendTime;
    }

    public String getText() {
        return text;
    }

    public void setText(String text) {
        this.text = text;
    }
}
