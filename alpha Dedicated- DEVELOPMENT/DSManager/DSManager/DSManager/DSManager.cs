using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net;
using System.IO;
using System.Threading;
using System.Diagnostics;
using System.Xml;
using System.Xml.Linq;

namespace DSManager
{
    public partial class DSManager : Form
    {
        public DSManager()
        {
            InitializeComponent();
        }

        private void DSManager_Load(object sender, EventArgs e)
        {
            timer1.Enabled = true;
        }

        private void CheckCreateRequest()
        {
            string post = "";
            string url = "http://enigmalabs.pe.hu/startLobby.php";
            string method = "POST";
            string rc = "";

            rc = ProcessURL(url, method, post);
            T_Return.Text = rc;

            string[] rcp = rc.Split(new char[1] {';'});

            foreach(string a in rcp)
            {
                switch (a)
                {
                    case "CS":
                        Process.Start(@"C:\Users\Pally\Desktop\Online2DS\WindowsNoEditor\Online2\Binaries\Win64\CS");
                        break;
                    case "CC":
                        Process.Start(@"C:\Users\Pally\Desktop\Online2DS\WindowsNoEditor\Online2\Binaries\Win64\CC");
                        break;

                    case "lobby":


                        // start the lobby executable
                        Process.Start(@"D:\Unreal\Projects\Packaged Projects\WindowsNoEditor\alpha\Binaries\Win64\lobby.lnk");

                        // call the endlobby php script by changing the url
                        string post2 = "";
                        string url2 = "http://enigmalabs.pe.hu/endLobby.php";
                        string method2 = "POST";

                        //call the process url function to end the lobby creation process.
                        ProcessURL(url2, method2, post2);

                        break;

                    case "PG" :
                        Process.Start(@"C:\Users\Pally\Desktop\Online2DS\WindowsNoEditor\Online2\Binaries\Win64\PG");
                        break; 

                }
            }

        }

        private string ProcessURL(string url, string method, string post)
        {
            ASCIIEncoding encoding = new ASCIIEncoding();
            byte[] data = encoding.GetBytes(post);
            string rc = "";
            WebRequest request = WebRequest.Create(url);
            if (post != "")
            {
                request.Method = method;
                request.ContentType = "application/x-www-form-urlencoded";
                request.ContentLength = data.Length;
                

                Stream stream = request.GetRequestStream();
                stream.Write(data, 0, data.Length);
                stream.Close();

                WebResponse response = request.GetResponse();
                stream = response.GetResponseStream();

                StreamReader sr = new StreamReader(stream);
                rc = sr.ReadToEnd();
            }
            else

            {
                try
                {
                    // Your Logic
                    WebResponse response = request.GetResponse();
                    StreamReader sr = new StreamReader(response.GetResponseStream());
                    rc = sr.ReadToEnd();
                }
                catch (WebException ex)
                {
                    // call the DsmError php script by changing the url
                    string post3 = "";
                    string url3 = "http://enigmalabs.pe.hu/DsmError.php";
                    string method3 = "POST";

                    //call the process url function to set the error message
                    ProcessURL(url3, method3, post3);



                    Process.Start(@"D:\Unreal\Projects\Alpha_source\alpha Dedicated- DEVELOPMENT\DSManager\DSManager\DSManager\obj\Release\DSManager.exe");

                   

                    Application.Exit();

                }
              
               
            }
            return rc;
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            CheckCreateRequest();
        }
    }
}
