package hr.foi.air.sport.viewModelServices;

import com.example.business.ILoginService;

public class LoginVmService implements ILoginVmService {
    private ILoginService loginService;

    public LoginVmService(ILoginService loginService){
        this.loginService = loginService;
    }

    public boolean LoginUser(String username, String password){
        return this.loginService.LoginUser(username, password);
    }
}
