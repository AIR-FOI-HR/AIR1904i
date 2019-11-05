package hr.foi.air.database.entities;

import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "chats")
public class Chat {
    @PrimaryKey(autoGenerate = true)
    int id;
    String title;
}
