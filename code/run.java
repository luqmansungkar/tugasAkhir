rs = doQuery("Select * from things");
try{
while(rs.next()){
   String id = rs.getString(1);
   String localId = rs.getString(4);
     if (rs.getString(6).length() > 0) {
         String access[] = rs.getString(6).split(",");
         String url = "http://localhost:8080/api/"+apiKey+"/lights/"+localId;
         String jsonString = executeREST("GET", url, null);
         if (jsonString != null && jsonString.charAt(0) != '[') {
             JSONObject jsonObject = new JSONObject(jsonString);
             JSONObject newJSON = jsonObject.getJSONObject("state");
             jsonObject = new JSONObject(newJSON.toString());

             for (String attr : access) {
                 if (attr.equals("on")) {
                     publish("sot/g/"+userID+"/undefined/"+id+"/"+attr+"/acc", attr+": "+(jsonObject.getBoolean(attr) == true ? "true" : "false" ));
                     System.out.println(attr+" lampu ke "+localId+" : "+(jsonObject.getBoolean(attr) == true ? "true" : "false" ));
                 }else{
                     publish("sot/g/"+userID+"/undefined/"+id+"/"+attr+"/acc", attr+": "+jsonObject.getInt(attr));
                     System.out.println(attr+" lampu ke "+localId+" : "+jsonObject.getInt(attr));
                 }                       
             }
         }
     }