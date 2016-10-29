package updated.eden2.org.eden2;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class Results extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Intent intent = getIntent();
        String toEdit = intent.getStringExtra("translation");
        String[] texts = toEdit.split(" ");
        for(int i = 0; i < texts.length; i++) {
            TextView textView = new TextView(this);
            textView.setHint(texts[i]);
        }
        setContentView(R.layout.activity_results);
    }

    protected void goToEditAct(View v) {
        Intent intent = new Intent(this,EditActivity.class);
        intent.putExtra("STRING_FROM_SERVER", "testString");
        startActivity(intent);
    }
}