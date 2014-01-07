<%@ page import="java.util.*" %>
<%@ page import="java.io.*,java.util.*,java.sql.*"%>
<%@ page import="javax.servlet.http.*,javax.servlet.*" %>
<%@ page import="javax.servlet.http.*,javax.servlet.*" %>
<%@ page import="org.json.simple.JSONObject"%>
<HTML>
<BODY>
<%
//    System.out.println( "Evaluating date now" );
//    Date date = new Date();
    // This scriptlet generates HTML output fo sho
//    out.println("<BR>Another Date: "+ date );
//    out.println( "<BR>Kents machine's address is " );
//    out.println( request.getRemoteHost());
/*
    if (request.getParameter("username") == null) {
        out.println("<BR>Please enter your username.");
    }else{
	out.println("<BR>"+request.getParameter("username"));
	}
	if(request.getParameter("password") == null){

	out.println("<BR>Please Enter your password");
	}else{
	out.println("<BR>"+request.getParameter("password"));
	}
								out.println( "<BR>Before Making the Connection" );
*/
   // JDBC driver name and database URL
   String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
   String DB_URL = "jdbc:mysql://10.0.3.110:3306/wre_ubm";
   //  Database credentials
   String USER = "jesse";
   String PASS = "Universal";
   Connection conn = null;
   Statement stmt = null;
   try{
      //STEP 2: Register JDBC driver
//								out.println( "<BR>inside try" );
	Class.forName("com.mysql.jdbc.Driver").newInstance();
      //STEP 3: Open a connection
//      out.println("Connecting to database...");
      conn = DriverManager.getConnection(DB_URL,USER,PASS);
//								out.println( "<BR>Defined the Connection" );
      //STEP 4: Execute a query
//							      out.println("Creating statement...");
      stmt = conn.createStatement();
      String sql, sql2;
      String employeeref = request.getParameter("employee_ref");
      String employeeentityid = request.getParameter("employee_entity_id");
      String paytypeid = request.getParameter("pay_type_id");
      String hourlywage = request.getParameter("hourly_wage");
      String salary = request.getParameter("salary");
      String companyentityid = request.getParameter("company_entity_id");
      String gradelevelid = request.getParameter("grade_level_id");
      String securitylevelid = request.getParameter("security_level_id");
      String statusid = request.getParameter("status_id");

//     out.println("before sql string");
      sql = "SELECT * FROM employee";
      sql2 = "INSERT INTO employee (employee_ref, employee_entity_id, pay_type_id, hourly_wage, salary, company_entity_id, grade_level_id, security_level_id, status_id) VALUES ('"+employeeref+"','"+employeeentityid+"','"+paytypeid+"','"+hourlywage+"','"+salary+"','"+companyentityid+"','"+gradelevelid+"','"+securitylevelid+"','"+statusid+"')"; 
  //    sql2 = "INSERT INTO employee VALUES(6,'test4','456',0,0,0,0,0,0,0)"; 
	stmt.executeUpdate(sql2);
//     out.println("before query");
	ResultSet rs = stmt.executeQuery(sql);

      //STEP 5: Extract data from result set
      while(rs.next()){
         //Retrieve by column name
         int id  = rs.getInt("employee_id");
         int age = rs.getInt("employee_entity_id");
         String first = rs.getString("employee_ref");

         //Display values
//       out.print("ID: " + id);
//        out.print(", Age: " + age);
//         out.print(", First: " + first);
      }
	JSONArray jsonData = "{'message' : 'This is my Message'}"; 
	String jsonp = request.getParameter("callback") + "(" + jsonData + ")";
//	out.println("This is a test");
//	out.println(jsonp);
	<c:out value="${jsonp}" />
      //STEP 6: Clean-up environment
      rs.close();
      stmt.close();
      conn.close();
   }catch(SQLException se){
      //Handle errors for JDBC
      se.printStackTrace();
   }catch(Exception e){
      //Handle errors for Class.forName
      e.printStackTrace();
   }finally{
      //finally block used to close resources
      try{
         if(stmt!=null)
            stmt.close();
      }catch(SQLException se2){
      }// nothing we can do
      try{
         if(conn!=null)
            conn.close();
      }catch(SQLException se){
         se.printStackTrace();
      }//end finally try
   }//end try
   System.out.println("Goodbye!");
%>
</BODY>
</HTML>
