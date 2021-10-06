if [ -z $1 ] && [ -z $filepath ]; then
    echo "not set filepath"
else
    if [ -z $1 ]; then
        file $filepath
    else
        file $1
    fi
fi
