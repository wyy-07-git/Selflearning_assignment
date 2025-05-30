import { createClient } from '@supabase/supabase-js';

const supabase = createClient(
  process.env.SUPABASE_URL!,
  process.env.SUPABASE_ANON_KEY!
);

export async function POST(req: Request) {
  try {
    const { email, feedback } = await req.json();

    const { data, error } = await supabase
      .from('user_feedback')
      .insert([{ email, feedback }]);

    if (error) {
      console.error('🔥 Supabase insert error:', error);
      return new Response(JSON.stringify({ error }), { status: 500 });
    }

    return new Response(JSON.stringify({ success: true }), { status: 200 });
  } catch (e) {
    console.error('🔥 Request handler error:', e);
    return new Response('Internal server error', { status: 500 });
  }
}
