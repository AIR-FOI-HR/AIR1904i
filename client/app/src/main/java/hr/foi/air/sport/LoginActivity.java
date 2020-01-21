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

import com.example.business.LoginService;

import butterknife.ButterKnife;
import butterknife.OnClick;
import hr.foi.air.database.repositories.UsersRepository;
import hr.foi.air.sport.viewModelServices.ILoginVmService;
import hr.foi.air.sport.viewModelServices.LoginVmService;

/**
 * The type Login activity.
 */
public class LoginActivity extends AppCompatActivity {

    private ILoginVmService loginVmService;
    private Button signInButton;
    private EditText usernameEdit;
    private EditText passwordEdit;
    private TextView textView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ButterKnife.bind(this);

        this.initializeComponents();
        this.makeTextClickable();

    }

    private void initializeComponents(){
        UsersRepository usersRepository = new UsersRepository();
        LoginService loginService = new LoginService(usersRepository);

        this.loginVmService = new LoginVmService(loginService);
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

        boolean isUserLoggedIn = this.loginVmService.LoginUser(username, password);

        if(isUserLoggedIn) {
            startActivity(new Intent(LoginActivity.this, HomeActivity.class));
        }
    }
}
