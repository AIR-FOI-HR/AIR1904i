package hr.foi.air.sport;

import android.content.Intent;
import android.os.Bundle;
import android.text.SpannableString;
import android.text.Spanned;
import android.text.method.LinkMovementMethod;
import android.text.style.ClickableSpan;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.webservice.ISportifyApiResponseHandler;
import com.example.webservice.SportifyApiCaller;

import java.util.List;

import butterknife.ButterKnife;
import butterknife.OnClick;
import hr.foi.air.database.entities.User;
import hr.foi.air.database.repositories.UsersRepository;

/**
 * The type Login activity.
 */
public class LoginActivity extends AppCompatActivity implements ISportifyApiResponseHandler {

    private Button signInButton;
    private EditText usernameEdit;
    private EditText passwordEdit;
    private TextView textView;
    private SportifyApiCaller sportifyApiCaller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ButterKnife.bind(this);

        this.initializeComponents();
        this.makeTextClickable();

        this.sportifyApiCaller = new SportifyApiCaller(this);
    }

    private void initializeComponents(){
        UsersRepository usersRepository = new UsersRepository();

        this.signInButton = this.findViewById(R.id.signInButton);
        this.usernameEdit = this.findViewById(R.id.usernameEdit);
        this.passwordEdit = this.findViewById(R.id.passwordEdit);
    }

    private void makeTextClickable(){
        textView = findViewById(R.id.registrationLink);
        String text = "Don't have an account yet? Register here!";
        SpannableString spannableString = new SpannableString(text);
        ClickableSpan clickableSpan1 = new ClickableSpan() {
            @Override
            public void onClick(View widget) {
                startActivity(new Intent(LoginActivity.this, RegistrationActivity.class));
            }
        };

        spannableString.setSpan(clickableSpan1, 27,41, Spanned.SPAN_EXCLUSIVE_EXCLUSIVE);
        textView.setText(spannableString);
        textView.setMovementMethod(LinkMovementMethod.getInstance());
    }

    /**
     * On sign in button click.
     *
     * @param v the v
     */
    @OnClick(R.id.signInButton)
    public void OnSignInButtonClick(View v){
        String username = this.usernameEdit.getText().toString().trim();
        String password = this.passwordEdit.getText().toString().trim();

        this.sportifyApiCaller.GetUsers();
    }

    @Override
    public void onResponseReceived(Object response) {
        List<User> users = (List<User>)response;
    }
}
