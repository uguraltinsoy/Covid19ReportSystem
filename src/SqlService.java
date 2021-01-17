import org.json.JSONArray;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.*;

public class SqlService {

    /*private static String dbLocation = "jdbc:mysql://localhost:3306/supermarket?useUnicode=true&useLegacyDatetimeCode=false&serverTimezone=Turkey";
    private static String name = "root";
    private static String password = "6110";
    private static Connection myConnection;
    private static Statement myStatement;*/

    private static String BASE_URL = "https://corona.lmao.ninja/v2/countries?yesterday&sort";

    public static void main(String[] args) {
        try {
            //myConnection = (Connection) DriverManager.getConnection(dbLocation,name,password);
            //myStatement = myConnection.createStatement();

            JSONArray jsonArray = getCountry();
            for (int i = 0; i < jsonArray.length();i++){
                try {
                    JSONObject jsonObject = jsonArray.getJSONObject(i);
                    long updated = jsonObject.getLong("updated"); // 14
                    String country = jsonObject.getString("country"); //40
                    JSONObject countryInfo = jsonObject.getJSONObject("countryInfo");
                    int _id = countryInfo.getInt("_id");
                    String flag = countryInfo.getString("flag"); //50
                    int cases = jsonObject.getInt("cases"); //10
                    int todayCases = jsonObject.getInt("todayCases");
                    int deaths = jsonObject.getInt("deaths");
                    int todayDeaths = jsonObject.getInt("todayDeaths");
                    int recovered = jsonObject.getInt("recovered");
                    int todayRecovered = jsonObject.getInt("todayRecovered");
                    int active = jsonObject.getInt("active");
                    int critical = jsonObject.getInt("critical");
                    int casesPerOneMillion = jsonObject.getInt("casesPerOneMillion");
                    int deathsPerOneMillion = jsonObject.getInt("deathsPerOneMillion");
                    int tests = jsonObject.getInt("tests");
                    int testsPerOneMillion = jsonObject.getInt("testsPerOneMillion");
                    int population = jsonObject.getInt("population");
                    String  continent = jsonObject.getString("continent");
                    int oneCasePerPeople = jsonObject.getInt("oneCasePerPeople");
                    int oneDeathPerPeople = jsonObject.getInt("oneDeathPerPeople");
                    int oneTestPerPeople = jsonObject.getInt("oneTestPerPeople");
                    double activePerOneMillion = jsonObject.getDouble("activePerOneMillion");
                    double recoveredPerOneMillion = jsonObject.getDouble("recoveredPerOneMillion");
                    double criticalPerOneMillion = jsonObject.getDouble("criticalPerOneMillion");

                    System.out.println(String.format("Date %-14s Country : %-40s Flag : %-50s Today Cases : %-10s Today Deaths : %-10s Today Recovered : %-10s",updated,country,flag,todayCases,todayDeaths,todayRecovered));

                }catch (Exception e){
                    System.out.println(e.getMessage());
                }


            }
        }catch (Exception e){
            System.out.println(e.getMessage());
        }
    }

    private static JSONArray getCountry(){
        try{
            URL url = new URL(BASE_URL);
            URLConnection uC = url.openConnection();
            BufferedReader in = new BufferedReader(new InputStreamReader(uC.getInputStream()));
            String  inputLine;
            JSONArray cout = null;
            while ((inputLine = in.readLine())!= null){
                cout = new JSONArray(inputLine);
            }
            return cout;
        }catch (Exception e){
            System.out.println(e.getMessage());
            return null;
        }
    }
}
