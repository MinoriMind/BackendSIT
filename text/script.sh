tail -n 40 file.txt > file2.txt
head -n 10 file2.txt > file3.txt
grep "coco" file2.txt | sed "s/coco/cucu/g" | head -n 3 >> file3.txt
sort file3.txt | uniq -c > file3.txt
