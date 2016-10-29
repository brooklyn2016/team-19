package updated.eden2.org.eden2;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class EditActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Intent intent = getIntent();
        String toEdit = intent.getStringExtra("STRING_FROM_SERVER");
        String[] texts = toEdit.split(" ");
        for(int i = 0; i < texts.length; i++) {
            TextView textView = new TextView(this);
            textView.setHint(texts[i]);
        }
        setContentView(R.layout.activity_edit);
    }

    protected void goToResultsAct(View v) {
        //TODO: post to server
        finish();
    }
}