package updated.eden2.org.eden2;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

public class Results extends AppCompatActivity {

    public String toEdit = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Intent intent = getIntent();
        toEdit = intent.getStringExtra("translation");
        LinearLayout layout = new LinearLayout(this);
        LinearLayout.LayoutParams params =
                new LinearLayout.LayoutParams(
                        ViewGroup.LayoutParams.WRAP_CONTENT,
                        ViewGroup.LayoutParams.WRAP_CONTENT, 0.0F);
        String[] texts = toEdit.split(" ");
        for(int i = 0; i < texts.length; i++) {
            TextView textView = new TextView(this);
            textView.setText(texts[i]);
            layout.addView(textView);
        }
        setContentView(R.layout.activity_results);
    }

    protected void goToEditAct(View v) {
        Intent intent = new Intent(this,EditActivity.class);
        intent.putExtra("STRING_FROM_SERVER", toEdit);
        startActivity(intent);
    }
}