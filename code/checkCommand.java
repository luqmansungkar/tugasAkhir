void checkCommand(String topic, String command){
    String msg = "";
    String[] topicArr = topic.split("/");
    String localId = getLocalId(topicArr[4]);
    String tipe = getTipe(topicArr[4]);
    String attr = topicArr[5];
    String allowed[] = getAttr(topicArr[4]).split(","); 
    String url = "";
    if (arrayContain(allowed,attr)) {
        if (tipe.equals("Lampu")) {
            url = "http://localhost:8080/api/"+apiKey+"/lights/"+localId+"/state";
        }else{
            url = "http://localhost:8080/api/"+apiKey+"/groups/"+localId+"/action";
        }
        if (Integer.parseInt(localId) > 0) {
            msg = executeREST("PUT", url, "{\""+attr+"\":"+command+"}");
        }else{
            System.out.println("id lampu tidak ditemukan");
        }
    }else{
        System.out.println("atribut tidak diperbolehkan untuk di kontrol");
    }
}