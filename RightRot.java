import java.util.Scanner;

public class RightRot {

	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);		
		int n;
		int r;
		int q;
		n = sc.nextInt();
		r = sc.nextInt();
		q = sc.nextInt();
	
		int[] ar = new int[n];
		for(int i=0;i<n;i++){
			ar[i]= sc.nextInt();
		}
		
		int test;
		int count=0;
		int realfunda = r % n;
		if(realfunda!=0){
			for(int j=1;j<=realfunda;j++)
			{
			int temp = ar[n-1];
			count++;
			for(int i=n-2;i>=0;i--){
				test = ar[i];
				ar[i+1]=test;
			}
			
			ar[0]=temp;
			}
			
		}
		
		
		for(int i=1;i<=q;i++){
			int check;
			check = sc.nextInt();
			System.out.println(ar[check]);
		}
	}

}
