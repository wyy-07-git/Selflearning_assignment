
import { NextResponse } from 'next/server'
export const runtime = 'edge';

export async function POST(req: Request) {
    const formdata = await req.formData();
    const email = formdata.get('email');

    if(!email) {
        return NextResponse.json({ error: 'Email is required' }, { status: 400 });
    }

    return NextResponse.json({ message: 'Email received', email }, { status: 200 });
   
}
