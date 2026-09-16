using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using myws;


public partial class _Default : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        callWS();
    }
    protected void callWS()
    {
        myws.GetingPersonByNationalIdAndBirthDate mytest = new myws.GetingPersonByNationalIdAndBirthDate();
      string  username = "agriPahneh";
      string password = "2@ej5D6*7";

      string NationalId = "0071472797";
      string BirthDate = "13560427";
      PersonInformation myresult = new PersonInformation();
      myresult=mytest.GetPersonInfo(username, password, NationalId, BirthDate);

      Response.Write(myresult.firstName);
    }
}