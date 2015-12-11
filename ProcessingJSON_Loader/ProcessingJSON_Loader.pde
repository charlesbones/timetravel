JSONArray values;
String address = "https://dennisbu.octans.uberspace.de/audio/";
String query = "love";

void setup() {

  values = loadJSONArray("https://dennisbu.octans.uberspace.de/audio/api.php?match=" + query);
  for (int i = 0; i < values.size(); i++) {   
    JSONObject path = values.getJSONObject(i); 
    String file = address + path.getString("file");
    println(file);
  }
  
  
}