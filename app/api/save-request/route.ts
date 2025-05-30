import { createClient } from '@supabase/supabase-js';

const supabase = createClient(
  process.env.SUPABASE_URL!,
  process.env.SUPABASE_ANON_KEY!
);

export async function POST(req: Request) {
  try {
    const { unit, issue } = await req.json();

    const { error } = await supabase
      .from('unit_maintaence')
      .insert([{ unit, issue }]);

    if (error) {
      return new Response(error.message, { status: 500 });
    }

    return new Response(JSON.stringify({ success: true }), { status: 200 });
  } catch (e: any) {
    return new Response('Unexpected server error', { status: 500 });
  }
}
