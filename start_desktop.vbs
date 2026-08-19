Set WshShell = CreateObject("WScript.Shell")
Set fso = CreateObject("Scripting.FileSystemObject")

appDir = fso.GetParentFolderName(WScript.ScriptFullName) & "\desktop"
electronExe = appDir & "\node_modules\electron\dist\electron.exe"

' Check if server is reachable
On Error Resume Next
Set http = CreateObject("MSXML2.XMLHTTP")
http.Open "GET", "http://localhost/antrian_bri_console/", False
http.Send
If Err.Number <> 0 Or http.Status <> 200 Then
    MsgBox "Server not reachable at http://localhost/antrian_bri_console" & vbCrLf & "Make sure WAMP / Apache is running.", vbCritical, "Antrian BRI Console"
    WScript.Quit 1
End If
On Error GoTo 0

' Launch Electron directly (no cmd window)
WshShell.Run """" & electronExe & """ """ & appDir & """", 0, False
