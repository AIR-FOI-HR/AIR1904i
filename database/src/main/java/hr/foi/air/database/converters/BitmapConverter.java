package hr.foi.air.database.converters;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Base64;

import androidx.room.TypeConverter;

import java.io.ByteArrayOutputStream;

public class BitmapConverter {
    @TypeConverter
    public static String toString(Bitmap bmp) {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bmp.compress(Bitmap.CompressFormat.PNG, 100, baos);
        byte[] byteArray = baos.toByteArray();
        String img = Base64.encodeToString(byteArray, Base64.DEFAULT);
        return img;
    }

    @TypeConverter
    public static Bitmap fromString(String img) {
        byte[] byteArray = Base64.decode(img, Base64.DEFAULT);
        Bitmap bmp = BitmapFactory.decodeByteArray(byteArray, 0, byteArray.length);
        return bmp;
    }
}
