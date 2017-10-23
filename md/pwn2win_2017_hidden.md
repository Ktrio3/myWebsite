# Hidden Program

This was quite an elegant little challenge. Nothing fancy: no ROP, no web stuff,
just abusing C's type casting. This challenge was a warm-up, and it was a nice change
of pace.

The code for this challenge can be found in the downloads link above.

## A *Short* Misdirection

The challenge requires you to connect to a remote service, and play a "game". The game goes
like this:

It first asks you to enter a number, a string, and a second string. If string\[number\] is the same
as the second string, you win. However, we don't want to win this game; we want the flag!

Taking a look at the code, we see the following struct:

		typedef struct
		{
				char flag[SHRT_MAX+1];
				char in[SHRT_MAX+1];
				char sub[SHRT_MAX+1];
				int n;
		} player;

Later in the code, we see that the flag is placed into the flag member of this struct. Perfect, how do
we get it?

Before we dive into that, let's think about what the struct looks like on the stack. Assuming the
stack starts at 0, we have:

|Addr/length|Content|
| --- | --- |
| 3*(SHRT_MAX + 1) + 3 | flag |
| 2*(SHRT_MAX + 1) + 3 | in |
| SHRT_MAX + 1 + 3 | sub |
| 0-3 | n |

With the stack in our mind, there is a piece of code we could use to access the flag:

		if(strcmp(&p1.in[p1.n],p1.sub)==0) printf("Congratulations!! YOU WIN!!\n");

In the code above, p1.n is controlled by us; if we enter a negative value, we can point back at the
flag string! We need to point backwards by SHRT\_MAX + 1, or 32768 (0x8000). Unfortunately, the code takes the absolute value of want we entered, and doesn't allow values greater than SHRT\_MAX:

		scanf(" %d", &p1.n);
        if(p1.n>SHRT_MAX)
            printf("Invalid number\n\n");
		...

		p1.n = (short)abs((short)p1.n);

We can enter any negative value we want, but it will get converted back to a positive number.
However, if we enter -32768, the value we want, it stays negative, and the flag prints! We have solved
the challenge! But why did this work?

## Casting

The key is in the abs function. Note that n is an integer in the struct.

		p1.n = (short)abs((short)p1.n);

The following is executed as such:

1. p1.n is cast to a short
2. abs() is called; abs takes and *returns* an integer
3. The return value of abs() is converted to a short

Execution for -32768:

1. -32768(0xFFFF8000) becomes -32768(0x8000), as this is in short range
2. -32768(0x8000) becomes 32768(0x00008000)
3. 32768 is cast to a short. 0x00008000 becomes 0x8000. This is -32768!

Thus, our negative value has squeezed past the filter, and we can access the flag!
