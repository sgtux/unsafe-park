function mail_input { 
    echo "ehlo vuln.lab"
    echo "MAIL FROM: atacante@vuln.lab"
    echo "RCPT TO: vitima@vuln.lab"
    echo "DATA"
    echo "From: atacante@vuln.lab"
    echo "To: vitima@vuln.lab"
    echo "Subject: Testing one two three"
    echo "This is only a test. Please do not panic. If this works, then all is well, else all is not well."
    echo "In closing, Lorem ipsum dolor sit amet, consectetur adipiscing elit."
    echo "."
    echo "quit"
}

mail_input | nc 172.22.22.10 25