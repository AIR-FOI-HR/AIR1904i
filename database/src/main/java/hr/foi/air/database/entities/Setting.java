package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;
import androidx.room.PrimaryKey;

@Entity(tableName = "settings")
public class Setting {
    @PrimaryKey(autoGenerate = true)
    int id;
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "user_id")
    @ColumnInfo(index = true, name = "user_id")
    int userId;

    String key;
    String value;
}
