import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.*;
import java.util.ArrayList;

import org.json.simple.*;
import org.json.simple.parser.JSONParser;

public class SqlService {

    private static String BASE_URL = "https://api.covid19api.com/dayone/country/";
    private static JSONParser parser = new JSONParser();
    private static String[] count = {""};

    public static void main(String[] args) {

        JSONArray country = (JSONArray) getCountry("Turkey");
        for (Object o : country){
            JSONObject test = (JSONObject) o;
            System.out.println(test);
        }
    }

    private static JSONArray getCountry(String country){
        try{
            URL url = new URL(BASE_URL+country);
            URLConnection uC = url.openConnection();
            BufferedReader in = new BufferedReader(new InputStreamReader(uC.getInputStream()));
            String  inputLine;
            JSONArray cout = null;
            while ((inputLine = in.readLine())!= null ){
                cout = (JSONArray) parser.parse(inputLine);
            }
            return cout;
        }catch (Exception e){
            System.out.println(e.getMessage());
            return null;
        }
    }
}
